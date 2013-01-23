<?php
/* ***** BEGIN LICENSE BLOCK *****
 * Version: NPL 1.1/GPL 2.0/LGPL 2.1
 *
 * The contents of this file are subject to the Netscape Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/NPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is Mozilla Communicator client code.
 *
 * The Initial Developer of the Original Code is
 * Netscape Communications Corporation.
 * Portions created by the Initial Developer are Copyright (C) 1998
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 * Henri Sivonen, hsivonen@iki.fi
 *
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either the GNU General Public License Version 2 or later (the "GPL"), or
 * the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * in which case the provisions of the GPL or the LGPL are applicable instead
 * of those above. If you wish to allow use of your version of this file only
 * under the terms of either the GPL or the LGPL, and not to allow others to
 * use your version of this file under the terms of the NPL, indicate your
 * decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL or the LGPL. If you do not delete
 * the provisions above, a recipient may use your version of this file under
 * the terms of any one of the NPL, the GPL or the LGPL.
 *
 * ***** END LICENSE BLOCK ***** */

/*
 * For the original C++ code, see
 * http://lxr.mozilla.org/seamonkey/source/intl/uconv/src/nsUTF8ToUnicode.cpp
 * http://lxr.mozilla.org/seamonkey/source/intl/uconv/src/nsUnicodeToUTF8.cpp
 *
 * The latest version of this file can be obtained from
 * http://iki.fi/hsivonen/php-utf8/
 *
 * Version 1.0, 2003-05-30
 */

namespace Db\Filter;
use Zend\Filter\StringTrim;

class Normalize extends AbstractFilter
{
    function filter($string)
    {
        $filterStringTrim = new StringTrim();
        $string = $filterStringTrim->filter($string);

        $string = $this->unprefix($string);

        $string = $filterStringTrim->filter($string);

        $ext = array(192, 193, 194, 195, 196, 197,
                     224, 225, 226, 227, 228, 229,
                     199, 231, 200, 201, 202, 203,
                     232, 233, 234, 235, 204, 205,
                     206, 207, 236, 237, 238, 239,
                     210, 211, 212, 213, 214, 216,
                     242, 243, 244, 245, 246, 248,
                     209, 241, 217, 218, 219, 220,
                     249, 250, 251, 252, 221, 255, 253);

        $norm = array(65, 65, 65, 65, 65, 65, 97,
                      97, 97, 97, 97, 97, 67, 99,
                      69, 69, 69, 69, 101, 101, 101,
                      101, 73, 73, 73, 73, 105, 105,
                      105, 105, 79, 79, 79, 79, 79, 79,
                      111, 111, 111, 111, 111, 111, 78,
                      110, 85, 85, 85, 85, 117, 117, 117,
                      117, 89, 121, 121);

        $string = $this->utf8tounicode($string);
        // Using array insersect is slower
        foreach ($ext as $k => $e) {
            if ($pos = array_search($e, $string)) {
                $string[$pos] = $norm[$k];
            }
        }
        $string = $this->unicodetoutf8($string);

        return $string;
    }

    function utf8ToUnicode(&$str)
    {
        $mState = 0;     // cached expected number of octets after the current octet
                       // until the beginning of the next UTF8 character sequence
        $mUcs4  = 0;     // cached Unicode character
        $mBytes = 1;     // cached expected number of octets in the current sequence

        $out = array();

        $len = strlen($str);
        for($i = 0; $i < $len; $i++) {
            $in = ord($str{$i});
            if (0 == $mState) {
                // When mState is zero we expect either a US-ASCII character or a
                // multi-octet sequence.
                if (0 == (0x80 & ($in))) {
                    // US-ASCII, pass straight through.
                    $out[] = $in;
                    $mBytes = 1;
                } else if (0xC0 == (0xE0 & ($in))) {
                    // First octet of 2 octet sequence
                    $mUcs4 = ($in);
                    $mUcs4 = ($mUcs4 & 0x1F) << 6;
                    $mState = 1;
                    $mBytes = 2;
                } else if (0xE0 == (0xF0 & ($in))) {
                    // First octet of 3 octet sequence
                    $mUcs4 = ($in);
                    $mUcs4 = ($mUcs4 & 0x0F) << 12;
                    $mState = 2;
                    $mBytes = 3;
                } else if (0xF0 == (0xF8 & ($in))) {
                    // First octet of 4 octet sequence
                    $mUcs4 = ($in);
                    $mUcs4 = ($mUcs4 & 0x07) << 18;
                    $mState = 3;
                    $mBytes = 4;
                } else if (0xF8 == (0xFC & ($in))) {
                /* First octet of 5 octet sequence.
                 *
                 * This is illegal because the encoded codepoint must be either
                 * (a) not the shortest form or
                 * (b) outside the Unicode range of 0-0x10FFFF.
                 * Rather than trying to resynchronize, we will carry on until the end
                 * of the sequence and let the later error handling code catch it.
                 */
                    $mUcs4 = ($in);
                    $mUcs4 = ($mUcs4 & 0x03) << 24;
                    $mState = 4;
                    $mBytes = 5;
                } else if (0xFC == (0xFE & ($in))) {
                    // First octet of 6 octet sequence, see comments for 5 octet sequence.
                    $mUcs4 = ($in);
                    $mUcs4 = ($mUcs4 & 1) << 30;
                    $mState = 5;
                    $mBytes = 6;
                } else {
                    /* Current octet is neither in the US-ASCII range nor a legal first
                    * octet of a multi-octet sequence.
                    */
                    return false;
                }
            } else {
                // When mState is non-zero, we expect a continuation of the multi-octet
                // sequence
                if (0x80 == (0xC0 & ($in))) {
                    // Legal continuation.
                    $shift = ($mState - 1) * 6;
                    $tmp = $in;
                    $tmp = ($tmp & 0x0000003F) << $shift;
                    $mUcs4 |= $tmp;

                    if (0 == --$mState) {
                        /* End of the multi-octet sequence. mUcs4 now contains the final
                         * Unicode codepoint to be output
                         *
                          * Check for illegal sequences and codepoints.
                         */

                        // From Unicode 3.1, non-shortest form is illegal
                        if (((2 == $mBytes) && ($mUcs4 < 0x0080)) ||
                            ((3 == $mBytes) && ($mUcs4 < 0x0800)) ||
                            ((4 == $mBytes) && ($mUcs4 < 0x10000)) ||
                            (4 < $mBytes) ||
                            // From Unicode 3.2, surrogate characters are illegal
                            (($mUcs4 & 0xFFFFF800) == 0xD800) ||
                            // Codepoints outside the Unicode range are illegal
                            ($mUcs4 > 0x10FFFF)) {

                            return false;
                        }

                        if (0xFEFF != $mUcs4) {
                            // BOM is legal but we don't want to output it
                            $out[] = $mUcs4;
                        }
                        //initialize UTF8 cache
                        $mState = 0;
                        $mUcs4  = 0;
                        $mBytes = 1;
                    }
                } else {
                    /* ((0xC0 & (*in) != 0x80) && (mState != 0))
                    *
                    * Incomplete multi-octet sequence.
                    */

                    return false;
                }
            }
        }

        return $out;
    }


    function unicodeToUtf8(&$arr)
    {
        $dest = '';
        foreach ($arr as $src) {
            if($src < 0) {
                return false;
            } else if ( $src <= 0x007f) {
                $dest .= chr($src);
            } else if ($src <= 0x07ff) {
                $dest .= chr(0xc0 | ($src >> 6));
                $dest .= chr(0x80 | ($src & 0x003f));
            } else if($src == 0xFEFF) {
                // nop -- zap the BOM
            } else if ($src >= 0xD800 && $src <= 0xDFFF) {
                // found a surrogate
                return false;
            } else if ($src <= 0xffff) {
                $dest .= chr(0xe0 | ($src >> 12));
                $dest .= chr(0x80 | (($src >> 6) & 0x003f));
                $dest .= chr(0x80 | ($src & 0x003f));
            } else if ($src <= 0x10ffff) {
                $dest .= chr(0xf0 | ($src >> 18));
                $dest .= chr(0x80 | (($src >> 12) & 0x3f));
                $dest .= chr(0x80 | (($src >> 6) & 0x3f));
                $dest .= chr(0x80 | ($src & 0x3f));
            } else {
                // out of range
                return false;
            }
        }
        return $dest;
    }


    public function unprefix($value)
    {
        $_prefix_ignore = array(
            array('l' => 2, 's' => 'a '),
            array('l' => 3, 's' => 'an '),
            array('l' => 4, 's' => 'the '),
            array('l' => 3, 's' => 'la '),
            array('l' => 3, 's' => 'le '),
            array('l' => 2, 's' => "l'"),
            array('l' => 1, 's' => "[")
        );

        $start = 0;
        foreach ($_prefix_ignore as $p) {
            if (!strncasecmp($p['s'], $str, $p['l'])) {
                $start = $p['l'];
                break;
            }
        }
        if ($start) return mb_substr($str, $start);

        return $str;
    }
}
<?php

namespace DbEtreeOrg\Service;

class Menu {
    use \Db\Component\ServiceManager
        ;

    static public function addRecent($section, $id, $limit = 10) {

        if (!isset($_SESSION['menu'][$section])) $_SESSION['menu'][$section] = array();
        if (in_array($id, $_SESSION['menu'][$section])) {
            unset($_SESSION['menu'][$section][array_search($id, $_SESSION['menu'][$section])]);
        }
        array_unshift($_SESSION['menu'][$section], $id);
        $_SESSION['menu'][$section] = array_slice($_SESSION['menu'][$section], 0, $limit);

        return true;
    }

    static public function getRecent($section = '') {
        if ($section) return $_SESSION['menu'][$section];

        return $_SESSION['menu'];
    }
}
<?php

class Hibe3 
{
	 public function menu()
    {
        //nama/link/icon
        $menu = array(
            array("menu","Home",array("","","",""),""),
            array("menu","Organsiasi",array("Organisasi","list_organisasi","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu","Program",array("Program","list_organisasi","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu","Crwodfunding",array("Crwodfunding","list_organisasi","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("avatar","Profil",array("","","",""),""),
          
        );
        
        return $menu;
    } 
} 
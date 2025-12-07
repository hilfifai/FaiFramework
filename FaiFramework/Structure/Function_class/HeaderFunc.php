<?php 

class HeaderFunc{
    public static function search(){
        $i=0;
        $page['load']['search'][$i]['Group Title']='Organisasi';
        $page['load']['search'][$i]['database']['utama']='organisasi';
        $ii=0;
        $page['load']['search'][$i]['detail'][$ii]['row_database']='nama_database';
        $page['load']['search'][$i]['detail'][$ii]['tipe_row']='%';
        $ii++;
        $page['load']['search'][$i]['detail'][$ii]['row_database']='be3_id';
        $page['load']['search'][$i]['detail'][$ii]['tipe_row']='=';
        
        $i++;
        $page['load']['search'][$i]['Group Title']='Kegiatan';
        $page['load']['search'][$i]['database']['utama']='ltw_kegiatan_board';
        $ii=0;
        $page['load']['search'][$i]['detail'][$ii]['row_database']='nama_board';
        $page['load']['search'][$i]['detail'][$ii]['tipe_row']='%';
        $ii++;
        $page['load']['search'][$i]['detail'][$ii]['row_database']='be3_id';
        $page['load']['search'][$i]['detail'][$ii]['tipe_row']='=';

        return $page;
    }
}
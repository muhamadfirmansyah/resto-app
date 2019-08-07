<?php

function rp($rupiah){
    $hasil_rupiah = "Rp " . number_format($rupiah,0,',','.');
	return $hasil_rupiah;
}
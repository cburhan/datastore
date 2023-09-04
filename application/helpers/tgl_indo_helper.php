<?php
if (!function_exists('hitung_mundur')) {
    function hitung_mundur($datetime, $full = false)
    {
        $today = time();
        $createdday = strtotime($datetime);
        $datediff = abs($today - $createdday);
        $difftext = "";
        $years = floor($datediff / (365 * 60 * 60 * 24));
        $months = floor(($datediff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($datediff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor($datediff / 3600);
        $minutes = floor($datediff / 60);
        $seconds = floor($datediff);
        //year checker
        if ($difftext == "") {
            if ($years > 1)
                $difftext = $years . " tahun yang lalu";
            elseif ($years == 1)
                $difftext = $years . " tahun yang lalu";
        }
        //month checker
        if ($difftext == "") {
            if ($months > 1)
                $difftext = $months . " bulan yang lalu";
            elseif ($months == 1)
                $difftext = $months . " bulan yang lalu";
        }
        //month checker
        if ($difftext == "") {
            if ($days > 1)
                $difftext = $days . " hari yang lalu";
            elseif ($days == 1)
                $difftext = $days . " hari yang lalu";
        }
        //hour checker
        if ($difftext == "") {
            if ($hours > 1)
                $difftext = $hours . " jam yang lalu";
            elseif ($hours == 1)
                $difftext = $hours . " jam yang lalu";
        }
        //minutes checker
        if ($difftext == "") {
            if ($minutes > 1)
                $difftext = $minutes . " menit yang lalu";
            elseif ($minutes == 1)
                $difftext = $minutes . " menit yang lalu";
        }
        //seconds checker
        if ($difftext == "") {
            if ($seconds > 1)
                $difftext = $seconds . " detik yang lalu";
            elseif ($seconds == 1)
                $difftext = $seconds . " detik yang lalu";
        }
        return $difftext;
    }

    function tgl_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan2($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    function tgl_indonesia($tgl)
    {
        if ($tgl == null) {
            return "";
        } else {
            $ubah = gmdate($tgl, time() + 60 * 60 * 8);
            $pecah = explode("-", $ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal . ' ' . $bulan . ' ' . $tahun;
        }
    }

    function bulan2($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }

    function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

    function nama_hari($tanggal)
    {
        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        return $nama_hari;
    }

    function duit($angka)
    {
        $jadi = "Rp. " . number_format($angka, 2, ',', '.');
        return $jadi;
    }
}

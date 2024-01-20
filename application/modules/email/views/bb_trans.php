<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>

    <link href="<?= base_url('assets/'); ?>fonts/roboto.css" rel="stylesheet" type="text/css">

    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color: #8094ae;
            font-weight: 400;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        a {
            text-decoration: none;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        hr.line {
            border: 0;
            height: 0.5px;
            background: #8094ae;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
    <center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
                <td style="padding: 10px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align:left;padding-bottom:5px">
                                    <a><img style="height: 100px" src="cid:p2ep" alt="logo"></a>
                                </td>
                                <td style="text-align:right;padding-bottom:5px">
                                    <a><img style="height: 50px" src="cid:plnepi" alt="logo"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr>
                                <td style="padding: 30px 30px 20px">
                                    <p style="margin-bottom: 10px;">Yth. Bapak/Ibu <strong><?= $user_penerima; ?></strong>,</p>
                                    <p style="margin-bottom: 10px;" align="justify">Berikut kami informasikan bahwa user <strong><?= $user_uploader; ?></strong> telah melakukan Upload Data Manual Feeding pada aplikasi <strong>P2EP DATASTORE</strong> dengan detail sebagai berikut:</p>
                                    <table style="width:100%;max-width:620px;margin-bottom: 15px !important;">
                                        <tbody>
                                            <tr valign="top">
                                                <td style="width: 25%;">
                                                    Modul
                                                </td>
                                                <td style="width: 2%;">
                                                    :
                                                </td>
                                                <td style="width: 73%;">
                                                    <strong><?= $modul; ?></strong>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td style="width: 25%;">
                                                    Model
                                                </td>
                                                <td style="width: 2%;">
                                                    :
                                                </td>
                                                <td style="width: 73%;">
                                                    <strong><?= $model; ?></strong>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td style="width: 25%;">
                                                    Periode
                                                </td>
                                                <td style="width: 2%;">
                                                    :
                                                </td>
                                                <td style="width: 73%;">
                                                    <strong><?= $bulan . ' ' . $tahun; ?></strong>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td style="width: 25%;">
                                                    Nama File
                                                </td>
                                                <td style="width: 2%;">
                                                    :
                                                </td>
                                                <td style="width: 73%;">
                                                    <strong><?= $file; ?></strong>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td style="width: 25%;">
                                                    Waktu Upload
                                                </td>
                                                <td style="width: 2%;">
                                                    :
                                                </td>
                                                <td style="width: 73%;">
                                                    <?php
                                                    $tgl = date("Y-m-d", strtotime($time));
                                                    $jam = date("H:i:s", strtotime($time));
                                                    ?>
                                                    <strong><?= tgl_indo($tgl) . ' ' . $jam; ?></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p style="margin-bottom: 10px;">Klik tombol dibawah ini untuk masuk ke <strong>P2EP DATASTORE</strong>:</p>
                                    <a href="http://p2ep_datastore.plnepi.co.id/" style="background-color:#2596be;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:30px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 20px;margin-bottom: 10px !important;">Login</a>
                                    <p style="margin-bottom: 10px;" align="justify">Demikian pemberitahuan ini kami sampaikan. Atas perhatiannya kami ucapkan terimakasih.</p>
                                    <p style="margin-top: 10px; margin-bottom: 5px;">---- <br> Salam<br><strong>P2EP DATASTORE</strong></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding:25px 0 0;">
                                    <p style="font-size: 12px;">Email ini bersifat otomatis, harap untuk tidak membalasnya</p>
                                    <p style="font-size: 13px;">Copyright@2023 - PT PLN Energi Primer Indonesia</p>
                                    <p style="font-size: 13px;">#EnergyOfLife</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
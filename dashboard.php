<?php
session_start();

// بررسی اینکه کاربر لاگین کرده یا خیر
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // اتصال به پایگاه داده
    include 'incloud/bd-db-sa-ee-dd.php';

    // استفاده از اطلاعات کاربر از سشن
    $username = $_SESSION['username'];

    // دریافت اطلاعات کاربر از پایگاه داده
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مولد کد QR</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="./assets/css/vazir.css" rel="stylesheet">
    <link href="./assets/css/style.css?v1.12.3" rel="stylesheet">
    <link href="./assets/css/lang.css?v1.11" rel="stylesheet">
    <meta name="robots" content="index,follow,noodp">
    <meta name="googlebot" content="index,follow">
    <meta name="theme-color" content="#ff7900">
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico?v1.1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        @font-face {
            font-family: vazir;
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.eot');
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.eot?#iefix') format('embedded-opentype'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.woff') format('woff'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.ttf') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: vazir;
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.eot');
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.woff') format('woff'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.ttf') format('truetype');
            font-weight: bold;
        }

        @font-face {
            font-family: vazir;
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.eot');
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.eot?#iefix') format('embedded-opentype'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.woff') format('woff'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.ttf') format('truetype');
            font-weight: 300;
        }

        html {
            font-family: 'Quicksand', vazir;
            text-align: right;
        }

        body {
    background-color: #f4f4f9;
    font-family: 'Vazir', sans-serif;
    color: #333;
}

.container {
    max-width: 800px;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.alert {
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
}

.input-group .form-control {
    border-radius: 6px;
    padding: 10px;
}

button {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 12px 20px;
    border-radius: 6px;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(135deg, #0056b3, #004299);
}

#qrcodesub {
    display: block;
    margin: 20px auto;
    border: 3px dashed #007bff;
    padding: 15px;
    border-radius: 10px;
    background: white;
}

footer {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666;
}

    </style>
</head>

<body>
    <div class="clearfix"></div>
    <div class="container">
        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 col-centered">




            <div class="alert alert-info" id="defAlert">
                <p data-i18n="welcome_message">با احترام، لطفاً کدی که از پشتیبانی دریافت کرده&zwnj;اید را از گوشی خود
                    کپی کنید و آن را در بخش "your config" قرار دهید، سپس بررسی را انجام دهید.

                    <?php

    // نمایش اطلاعات کاربر
    echo "خوش آمدید، " . $row['username'] . "!";
    echo "شماره کاربری: " . $row['id'];

    // لینک خروج
    echo '<a href="logout.php">خروج</a>';
} else {
    // اگر کاربر لاگین نکرده است، هدایت به صفحه ورود
    header('Location: index.php');
    exit;
}
?>


                </p>
            </div>
            <p data-i18n="config_input">با احترام، لطفاً محل وارد کردن کانفیگ مورد نظر را مشخص کنید.

            </p>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="checkConf"
                        data-i18n="config_input_submit">بررسی</button>
                </span>
                <input class="form-control dirLeft" data-i18n-label="config_input_label" value="" id="defConfig"
                    placeholder="Your Config">
            </div>
            <div class="orClass"><small data-i18n="config_form_ortext">یا</small></div>
            <p data-i18n="config_form_label">تنظیمات زیر رو به&zwnj;صورت دستی تکمیل کنین:</p>
            <div class="xsWidth withSmallCenter">
                <select class="form-control dirLeft" id="protocol">
                    <option value="vless" selected="selected">VLESS</option>
                    <option value="vmess">VMESS</option>
                    <option value="trojan">TROJAN</option>
                </select>
                <select class="form-control dirLeft" id="stream">
                    <option value="ws" selected="selected">WS</option>
                    <option value="grpc">GRPC</option>
                </select>
                <input class="form-control dirLeft" data-i18n-label="config_form_uuid" id="uuid" placeholder="UUID">
                <input class="form-control dirLeft" data-i18n-label="config_form_port" id="port" type="number" min="0"
                    placeholder="PORT">
            </div>
            <div class="xsWidth">
                <input class="form-control dirLeft" data-i18n-label="config_form_cleanip" id="cleanIp"
                    data-toggle="tooltip" data-i18n-title="config_form_cleanip_tooltip"
                    data-original-title="یک IPv4/IPv6 وارد کرده یا آدرس یکی&zwnj;از سایت&zwnj;های پشت کلودفلر را وارد کنید (مقدار پیشفرض zula.ir است)"
                    placeholder="CleanIP">
                <input class="form-control dirLeft" data-i18n-label="config_form_sni" id="sni" placeholder="SNI">
                <input class="form-control dirLeft" data-i18n-label="config_form_path" id="path" placeholder="PATH">
            </div>
            <div class="minWidth none" id="grpcOnly">
                <select class="form-control dirLeft" id="grpcMode">
                    <option value="gun" selected="selected">gunMode</option>
                    <option value="multi">multiMode</option>
                </select>
                <input class="form-control dirLeft" data-i18n-label="config_form_serviceName" id="serviceName"
                    placeholder="ServiceName">
            </div>
            <div class="clearfix"></div>
            <label class="switch" data-toggle="tooltip" data-i18n-title="config_switch_mux_tooltip"
                data-original-title="بهبود سرعت برقراری اتصال و کاهش زمان تاخیر در ارسال&zwnj;ودریافت داده&zwnj;ها">
                <input type="checkbox" id="mux">
                <span class="slider round"></span>
                <strong data-i18n="config_switch_mux">Mux</strong>
            </label>
            <label class="switch" data-toggle="tooltip" data-i18n-title="config_switch_mux_tooltip">
                <strong data-i18n="config_switch_mux">گزینه mux را بزنید تا تنظیمات فعال شود</strong>
            </label>
            <div class="orClass"><small data-i18n="config_fragment_label">مقادیر فرگمنت</small></div>
            <div class="xsWidth">
                <input class="form-control dirLeft" data-i18n-label="config_fragment_packets" data-toggle="tooltip"
                    data-i18n-title="config_fragment_packets" id="packets" value="tlshello"
                    data-original-title="Packets" placeholder="Packets">
                <input class="form-control dirLeft" data-i18n-label="config_fragment_length" data-toggle="tooltip"
                    data-i18n-title="config_fragment_length" id="length" value="10-20" data-original-title="Length"
                    placeholder="Length">
                <input class="form-control dirLeft" data-i18n-label="config_fragment_interval" data-toggle="tooltip"
                    data-i18n-title="config_fragment_interval" id="interval" value="10-20"
                    data-original-title="Interval" placeholder="Interval">
            </div>
            <div class="muxForm none" id="muxForm">
                <div class="orClass"><small data-i18n="config_mux_label">مقدار Concurrency</small></div>
                <input class="form-control dirLeft" data-i18n-label="config_mux_concurrency" id="concurrency" value="8"
                    data-toggle="tooltip" data-i18n-title="config_mux_concurrency_tooltip"
                    data-original-title="یکی&zwnj;از اعداد مابین ۸ تا ۱۶ را انتخاب کنید (۸ به&zwnj;عنوان مقدار پیشفرض پیشنهاد می&zwnj;شود)"
                    placeholder="concurrency">
            </div>
            <div class="orClass"></div>

            <div class="clearfix"></div>
            <button class="btn btn-info" type="submit" id="qrGen" data-i18n="config_form_convert">تبدیل به
                فرگمنت</button>
            <div class="clearfix"></div>
            <textarea id="jsonOutput" class="jsonOutput"></textarea>
            <div class="clearfix"></div>
            <br>
            <div id="donate" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">حله</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="qrModal" class="modal fade" role="dialog" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title dirLeft">QRCode</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-warning" data-i18n="config_form_qrcode_alert">با احترام، لطفاً کد
                                مورد نظر را کپی کرده و در برنامه وارد کنید، سپس از بالا، دومین گزینه را انتخاب نمایید.




                            </div>
                        </div>
                        <div class="modal-footer">



                            <button type="button" class="btn btn-default" id="copyCode" data-i18n="config_form_copy">کپی
                                کد</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <textarea id="jsonData" rows="5" cols="50" placeholder="Enter JSON data here..."></textarea>
    <br>
    <button id="generateQR">برای تبدیل کلیک کنید</button>
    <br>
    <canvas id="qrcodesub">لینک ساباسکریپتشن</canvas>

    <script>
        document.getElementById('generateQR').addEventListener('click', function () {
            var jsonData = document.getElementById('jsonData').value.trim();
            if (jsonData === "") {
                alert("Please enter JSON data!");
                return;
            }

            // Create a unique directory name based on timestamp
            var folderName = 'qrcodes/' + Date.now();
            var qrPath = folderName + '/'; // No specific filename here

            // Create QR code for jsonData
            var qrJson = new QRious({
                element: document.getElementById('qrcodejson'),
                value: jsonData,
                size: 400
            });

            // Convert QR code for jsonData to image data URL
            var qrImageJson = qrJson.toDataURL();

            // Create QR code for data.json
            var qrDataJson = new QRious({
                element: document.getElementById('qrcodesub'),
                value: window.location.origin + '/fra/' + folderName + '/data.json',
                size: 400
            });

            // Convert QR code for data.json to image data URL
            var qrImageDataJson = qrDataJson.toDataURL();

            // Save QR code and JSON data to server
            saveQR(qrImageJson, qrImageDataJson, jsonData, folderName);
        });

        function saveQR(imageDataJson, imageDataDataJson, jsonData, folderName) {
            // Send QR images and JSON data to server
            Promise.all([
                fetch('saveqr.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ image: imageDataJson, json: jsonData, folder: folderName })
                }),
                fetch(folderName + '/data.json', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: jsonData
                })
            ])
                .then(([response1, response2]) => {
                    if (!response1.ok || !response2.ok) {
                        throw new Error('One or more network responses were not ok');
                    }
                    return Promise.all([response1.json(), response2.json()]);
                })
                .then(([data1, data2]) => {
                    alert('QR Code and JSON data saved successfully!');
                    console.log('QR Code response:', data1);
                    console.log('Data.json response:', data2);
                })
                .catch(error => {
                    console.error('There was an error saving the QR Code and JSON data:', error);
                });
        }
    </script>
    <footer>
        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/lang.js?v1.12.3"></script>
        <script src="./assets/js/script.js?v1.12.6"></script>
    </footer>
</body>

</html>

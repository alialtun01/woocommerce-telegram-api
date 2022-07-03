<?php
/**
 * Plugin Name: Telegram Bot Eklentisi
 * Description: Burası açıklama bölümü
 * Version: 1.0
 * Author: Ali Altun
 * Author URI: https://github.com/alialtun01/woocommerce-telegram-api
 */

 function admin_page_create(){
    add_menu_page("Telegram Ayarlar", "Telegram Ayarlar","manage_options","telegram-ayarlari","telegrambot");
 }

 add_action('admin_menu','admin_page_create');

 function telegrambot(){ ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <?php
  include 'ayarlar.php';
  
 }


 function sendMessage($id,$mesaj){
    $url = "https://api.telegram.org/bot".get_option("token_value")."/sendMessage?chat_id=".$id."&text=".$mesaj."&parse_mode=html";
    $ch = curl_init();
    $optionsArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );

    curl_setopt_array($ch, $optionsArray);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
 }
add_action("woocommerce_thankyou","yeni_siparis_bilgilendirme");
 function yeni_siparis_bilgilendirme($order_id){
    $order = new WC_Order(38);

    $urunler = "";
    foreach ($order->get_items() as $item_id => $item) {
        $urunler .= $item->get_name()." ".$item->get_quantity()." adet";
    }


    $fatura_adi = $order->get_billing_first_name()." ".$order->get_billing_last_name();
    $telefon = $order->get_billing_phone();

    $mesaj = "";
    $mesaj .= $fatura_adi." isimli kullanıcı sipariş verdi ";
    $mesaj .= "Kullanıcının telefon numarası : ".$telefon. " ";
    $mesaj .= "Satın Aldığını Ürünler : ";
    $mesaj .= $urunler;

    sendMessage("-646606983",$mesaj);
 }
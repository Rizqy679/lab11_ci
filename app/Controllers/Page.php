<?php
    namespace App\Controllers;

    class Page extends BaseController{
        public function about()
        {
           return View('about',['title' => 'Halaman About','content' => 'Ini adalah halaman About']);
        }
        public function contact()
        {
            return View('contact',['title' => 'Halaman kontak','content' => 'Ini adalah halaman kontak']);
        }

        public function faqs()
        {
            return View('faqs',['title' => 'Halaman faqs','content' => 'Ini adalah halaman faqs']);
        }
        public function tos()
        {
            return View('tos',['title' => 'Halaman tos','content' => 'Ini adalah halaman tos']);
        }
        public function artikel()
        {
            return View('artikel',['title' => 'Halaman artikel','content' => 'Ini adalah halaman artikel']);
        }
    }   
?>
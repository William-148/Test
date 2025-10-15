<?php

namespace App\Controllers;

class Language extends BaseController
{
    public function setLanguage()
    {
        $lang = $this->request->getPost('lang');
        if (in_array($lang, ['es', 'en'])) {
            session()->set('lang', $lang);
        }
        return redirect()->back();
    }
}


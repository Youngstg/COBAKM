<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidationURLImage implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $img_url = $value;

        // kalau bukan link google drive
        if (strpos($img_url, 'https://drive.google.com') === false) {
            // cek dulu apa yang dimasukkin cuma id, contoh: 1xbliaGFEIU1qYN6NkRqNidfms13PhJq4
            // atau isi inputnya gak diubah kalau user lagi di halaman edit
            if (strlen($img_url) >= 40) {
                $fail('Link Tidak Memenuhi Ketentuan');
            }
        } else {
            //  validation
            $link = explode('/file/d/', $img_url);

            if (count($link) >= 2) {
                $link_id = $link[1];
                $check_view = strpos($link_id, '/view');
                $check_preview = strpos($link_id, '/preview');
                if ($check_view !== false) {
                    $link_id = substr($link_id, 0, $check_view);
                } elseif ($check_preview !== false) {
                    $link_id = substr($link_id, 0, $check_preview);
                } else {
                    $link_id = null;
                }

                if ($link_id == null) {
                    $fail('Link Tidak Memenuhi Ketentuan');
                }
            }
        }
    }
}

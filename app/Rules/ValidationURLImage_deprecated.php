<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationURLImage implements Rule
{
    public function passes($attribute, $value)
    {
        // Retrieve the value of the 'is_adult' field from the request data
        $img_url = request()->input($attribute, false);

        // kalau bukan link google drive
        if (strpos($img_url, 'https://drive.google.com') === false) {
            // cek dulu apa yang dimasukkin cuma id, contoh: 1xbliaGFEIU1qYN6NkRqNidfms13PhJq4
            // atau isi inputnya gak diubah kalau user lagi di halaman edit
            if (strlen($img_url) <= 40) {
                return true;
            } // panjang id untuk gambar biasanya 33 karakter
            else {
                return false;
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
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    public function message()
    {
        return 'Link Tidak Memenuhi Ketentuan';
    }
}

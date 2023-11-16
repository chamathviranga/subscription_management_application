<?php

namespace App\Helpers;

class Messages {

    public static function Success() {
        if(session()->getFlashdata('success')){
            echo "
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '" . session()->getFlashdata('success') . "',
                        icon: 'success'
                    });
                </script>
            ";
        }

    }

    public static function Error() {
        if(session()->getFlashdata('error')){
            echo "
                <script>
                    Swal.fire({
                        title: 'Error!',
                        text: '" . session()->getFlashdata('error') . "',
                        icon: 'error'
                    });
                </script>
            ";
        }

    }

}
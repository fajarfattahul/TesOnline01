<?php 

function arkademy(string $nama, int $umur){

    $data = [
        "nama"                  => $nama,
        "umur"                  => $umur,
        "address"               => "Makassar",
        "hobbies"               => ["desain","ngoding","rebahan"],
        "is_married"            => false,
        "list_school"           => [
                                     ["name" => "SDN 229 Lamunre", "year_in" => 2003, "year_out" => 2009, "major" => false],
                                     ["name" => "SMPN 1 Belopa", "year_in" => 2009, "year_out" => 2012, "major" => false],
                                     ["name" => "SMAN 1 Belopa", "year_in" => 2012, "year_out" => 2015, "major" => "IPA"],
                                     ["name" => "STMIK Handayani", "year_in" => 2015, "year_out" => 2019, "major" => "Teknik Informatika"]
                                   ],
        "skills"                => [
                                     ["name" => "desain", "level" => "advance"],                               
                                     ["name" => "ngoding", "level" => "beginner"]                               
                                   ],
        "interest_in_coding"    => true
    ];

    echo json_encode($data);
}

arkademy("Fathur",21);

?>
<?php

class Konijn {
    private $oren;
    private $emotieTekst;
    private $voeten;

    public function __construct($oren, $voeten) {
        $this->oren = $oren;
        $this->genereerEmotie();
        $this->voeten = $voeten;
    }

    private function genereerEmotie() {
        $emoties = array(
            "blij" => "(^.^)",
            "verwonderd" => "(o.o)",
            "teleurgesteld" => "(>.<)",
            "vragend" => "(?.?)",
            "nadenkend" => "(&.&)"
        );
        $willekeurigeEmotie = array_rand($emoties);
        $this->emotieTekst = $emoties[$willekeurigeEmotie];
    }

    public function getKonijnOren() {
        return $this->oren;
    }
    
    public function getEmotie() {
        return $this->emotieTekst;
    }

    function getKonijnVoeten() {
        return $this->voeten;
    }
}

?>
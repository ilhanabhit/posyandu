<?php
// Contoh implementasi setter dan getter di kelas id
class id
{
    private $id_kader;

    public function setIdKader($id_kader)
    {
        $this->id_kader = $id_kader;
    }

    public function getIdKader()
    {
        return $this->id_kader;
    }
}

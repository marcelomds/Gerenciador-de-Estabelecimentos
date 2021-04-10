<?php


namespace App\Repositories\Establishment;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Establishment\Establishment;

class EstablishmentRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Establishment::class);
    }

    public function deleteEstablishment(int $id)
    {
        $establishment = $this->find($id);
        $establishment->delete();
    }

    public function updateEstablishment(array $request, int $id)
    {
        $establishment = $this->find($id);
        $establishment->update($request);

        return $establishment;
    }
}

<?php


namespace App\Repositories\Establishment;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Establishment\Establishment;

class EstablishmentRepository extends AbstractRepository
{
    /**
     * EstablishmentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel(Establishment::class);
    }

    /**
     * @param int $id
     */
    public function deleteEstablishment(int $id)
    {
        $establishment = $this->find($id);
        $establishment->delete();
    }

    /**
     * @param array $request
     * @param int $id
     * @return mixed
     */
    public function updateEstablishment(array $request, int $id)
    {
        $establishment = $this->find($id);
        $establishment->update($request);

        return $establishment;
    }
}

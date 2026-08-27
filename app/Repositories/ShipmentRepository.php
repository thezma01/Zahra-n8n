<?php

namespace App\Repositories;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;

class ShipmentRepository
{
    /**
     * The Shipment model instance.
     *
     * @var Shipment
     */
    protected $shipment;

    /**
     * ShipmentRepository constructor.
     *
     * @param Shipment $shipment
     */
    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * Get all shipment records.
     *
     * @return Collection|Shipment[]
     */
    public function getAll(): Collection
    {
        return $this->shipment->all();
    }

    /**
     * Find a shipment record by its ID.
     *
     * @param int $id
     * @return Shipment|null
     */
    public function findById(int $id): ?Shipment
    {
        return $this->shipment->find($id);
    }

    /**
     * Create a new shipment record.
     *
     * @param array $data
     * @return Shipment
     */
    public function create(array $data): Shipment
    {
        return $this->shipment->create($data);
    }

    /**
     * Update an existing shipment record.
     *
     * @param int $id
     * @param array $data
     * @return Shipment|null The updated shipment model or null if not found.
     */
    public function update(int $id, array $data): ?Shipment
    {
        $shipment = $this->shipment->find($id);
        if ($shipment) {
            $shipment->update($data);
        }
        return $shipment;
    }

    /**
     * Delete a shipment record.
     *
     * @param int $id
     * @return bool True if the shipment was deleted, false otherwise (e.g., not found).
     */
    public function delete(int $id): bool
    {
        $shipment = $this->shipment->find($id);
        if ($shipment) {
            return $shipment->delete();
        }
        return false;
    }
}

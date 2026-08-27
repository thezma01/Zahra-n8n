<?php

namespace App\Services;

use App\Repositories\ShipmentRepository;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShipmentService
{
    /**
     * @var ShipmentRepository
     */
    protected $shipmentRepository;

    /**
     * ShipmentService constructor.
     *
     * @param ShipmentRepository $shipmentRepository
     */
    public function __construct(ShipmentRepository $shipmentRepository)
    {
        $this->shipmentRepository = $shipmentRepository;
    }

    /**
     * Get all shipments.
     *
     * @return Collection|Shipment[]
     */
    public function getAllShipments(): Collection
    {
        return $this->shipmentRepository->getAll();
    }

    /**
     * Get a single shipment by ID.
     *
     * @param int $id
     * @return Shipment
     * @throws NotFoundHttpException
     */
    public function getShipmentById(int $id): Shipment
    {
        $shipment = $this->shipmentRepository->findById($id);
        if (!$shipment) {
            throw new NotFoundHttpException('Shipment not found.');
        }
        return $shipment;
    }

    /**
     * Create a new shipment.
     *
     * @param array $data
     * @return Shipment
     */
    public function createShipment(array $data): Shipment
    {
        return $this->shipmentRepository->create($data);
    }

    /**
     * Update an existing shipment.
     *
     * @param int $id
     * @param array $data
     * @return Shipment
     * @throws NotFoundHttpException
     */
    public function updateShipment(int $id, array $data): Shipment
    {
        $shipment = $this->shipmentRepository->update($id, $data);
        if (!$shipment) {
            throw new NotFoundHttpException('Shipment not found.');
        }
        return $shipment;
    }

    /**
     * Delete a shipment.
     *
     * @param int $id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function deleteShipment(int $id): bool
    {
        // First, check if the shipment exists to provide a specific "not found" error.
        $shipment = $this->shipmentRepository->findById($id);
        if (!$shipment) {
            throw new NotFoundHttpException('Shipment not found.');
        }

        // If it exists, attempt to delete. Eloquent's delete() returns true on success, false on failure.
        return $this->shipmentRepository->delete($id);
    }
}

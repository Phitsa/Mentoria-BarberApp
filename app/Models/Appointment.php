<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    public static function boot()
    {
        parent::boot(); // Chama o boot() da classe pai (Model)

        // Aqui você registra listeners que disparam em TODOS os Appointments
        static::creating(function ($appointment) {
            // Executado ANTES de criar um novo Appointment
        });

        static::updating(function ($appointment) {
            // Executado ANTES de atualizar
        });

        static::deleting(function ($appointment) {
            // Executado ANTES de deletar
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_service');
    }
}

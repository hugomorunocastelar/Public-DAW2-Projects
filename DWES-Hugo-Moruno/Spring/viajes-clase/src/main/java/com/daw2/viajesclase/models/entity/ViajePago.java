package com.daw2.viajesclase.models.entity;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import org.hibernate.annotations.CreationTimestamp;
import org.hibernate.annotations.UpdateTimestamp;

import java.time.Instant;
import java.time.LocalDateTime;

@NoArgsConstructor
@AllArgsConstructor
@Data
@Entity
@Table(name="viajes_pagos")
public class ViajePago {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long id;

    @OneToOne
    @JoinColumn(name = "inscripcion_viaje_id", nullable = false)
    private ViajeInscripcion viajeInscripcion;

    @Column(precision = 6, scale = 2)
    private Double pago;

    @CreationTimestamp
    private Instant createdAt;

    @Column(name = "deleted_at")
    private LocalDateTime deletedAt;

}

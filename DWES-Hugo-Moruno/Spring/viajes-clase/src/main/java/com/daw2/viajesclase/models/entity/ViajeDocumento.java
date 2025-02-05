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
@Table(name="viajes_documentos")
public class ViajeDocumento {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long id;

    @OneToOne
    @JoinColumn(name = "viaje_id", nullable = false)
    private Viaje viaje;

    @Column(nullable = false, length = 200)
    private String fichero;

    @Column(length = 200)
    private String titulo;

    @Lob
    private String observaciones;

    @CreationTimestamp
    private Instant createdAt;

    @Column(name = "deleted_at")
    private LocalDateTime deletedAt;

}

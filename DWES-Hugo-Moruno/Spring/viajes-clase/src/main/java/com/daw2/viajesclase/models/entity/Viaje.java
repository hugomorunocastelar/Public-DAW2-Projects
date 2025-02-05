package com.daw2.viajesclase.models.entity;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import org.hibernate.annotations.CreationTimestamp;
import org.hibernate.annotations.UpdateTimestamp;

import java.time.Instant;
import java.time.LocalDateTime;
import java.util.Date;

@NoArgsConstructor
@AllArgsConstructor
@Data
@Entity
@Table(name="viajes")
public class Viaje {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long id;

    @Column(unique = true, length = 15)
    private String referencia;

    @Column(nullable = false, length = 200)
    private String titulo;

    @Column(nullable = false, length = 250)
    private String slug;

    @Column(precision = 8, scale = 2)
    private Double precio;

    @Column(nullable = true)
    private Integer participantes;

    @Column(nullable = true)
    private Date salida;

    @Column(nullable = true)
    private Date llegada;

    @Column(nullable = true, length = 100)
    private String foto;

    @Lob
    private String observaciones;

    @Column()
    private Boolean active = true;

    @CreationTimestamp
    private Instant createdAt;

    @UpdateTimestamp
    private Instant updatedAt;

    @Column(name = "deleted_at")
    private LocalDateTime deletedAt;

}

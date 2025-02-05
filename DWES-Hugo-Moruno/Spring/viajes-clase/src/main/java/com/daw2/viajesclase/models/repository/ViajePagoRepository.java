package com.daw2.viajesclase.models.repository;

import com.daw2.viajesclase.models.entity.ViajePago;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ViajePagoRepository extends JpaRepository<ViajePago, Long> {}
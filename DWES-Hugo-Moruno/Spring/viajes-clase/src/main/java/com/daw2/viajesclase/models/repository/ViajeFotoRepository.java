package com.daw2.viajesclase.models.repository;

import com.daw2.viajesclase.models.entity.ViajeFoto;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ViajeFotoRepository extends JpaRepository<ViajeFoto, Long> {}
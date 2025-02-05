package com.daw2.viajesclase.models.repository;

import com.daw2.viajesclase.models.entity.ViajeDocumento;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ViajeDocumentoRepository extends JpaRepository<ViajeDocumento, Long> {}
package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.ViajeInscripcion;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface ViajeInscripcionService {

    List<ViajeInscripcion> findAll();
    ViajeInscripcion findById(Long id);
    ViajeInscripcion save(ViajeInscripcion ViajeInscripcion);
    void delete(ViajeInscripcion ViajeInscripcion);
    
}

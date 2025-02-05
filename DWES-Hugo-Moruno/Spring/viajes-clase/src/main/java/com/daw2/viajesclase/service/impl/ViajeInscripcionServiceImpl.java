package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.ViajeInscripcion;
import com.daw2.viajesclase.models.repository.ViajeInscripcionRepository;
import com.daw2.viajesclase.service.ViajeInscripcionService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class ViajeInscripcionServiceImpl implements ViajeInscripcionService {

    @Autowired
    private ViajeInscripcionRepository viajeInscripcionRepository;

    @Override
    public List<ViajeInscripcion> findAll() {
        return viajeInscripcionRepository.findAll();
    }

    @Override
    public ViajeInscripcion findById(Long id) {
        return viajeInscripcionRepository.findById(id).orElse(null);
    }

    @Override
    public ViajeInscripcion save(ViajeInscripcion ViajeInscripcion) {
        return viajeInscripcionRepository.save(ViajeInscripcion);
    }

    @Override
    public void delete(ViajeInscripcion ViajeInscripcion) {
        viajeInscripcionRepository.delete(ViajeInscripcion);
    }
}

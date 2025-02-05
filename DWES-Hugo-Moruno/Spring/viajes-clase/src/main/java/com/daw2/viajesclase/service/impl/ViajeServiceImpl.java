package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.Viaje;
import com.daw2.viajesclase.models.repository.ViajeRepository;
import com.daw2.viajesclase.service.ViajeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class ViajeServiceImpl implements ViajeService {

    @Autowired
    private ViajeRepository viajeRepository;

    @Override
    public List<Viaje> findAll() {
        return viajeRepository.findAll();
    }

    @Override
    public Viaje findById(Long id) {
        return viajeRepository.findById(id).orElse(null);
    }

    @Override
    public Viaje save(Viaje Viaje) {
        return viajeRepository.save(Viaje);
    }

    @Override
    public void delete(Viaje Viaje) {
        viajeRepository.delete(Viaje);
    }
}

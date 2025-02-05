package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.ViajePago;
import com.daw2.viajesclase.models.repository.ViajePagoRepository;
import com.daw2.viajesclase.service.ViajePagoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class ViajePagoServiceImpl implements ViajePagoService {

    @Autowired
    private ViajePagoRepository viajePagoRepository;

    @Override
    public List<ViajePago> findAll() {
        return viajePagoRepository.findAll();
    }

    @Override
    public ViajePago findById(Long id) {
        return viajePagoRepository.findById(id).orElse(null);
    }

    @Override
    public ViajePago save(ViajePago ViajePago) {
        return viajePagoRepository.save(ViajePago);
    }

    @Override
    public void delete(ViajePago ViajePago) {
        viajePagoRepository.delete(ViajePago);
    }
}

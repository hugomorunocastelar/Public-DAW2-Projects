package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.ViajeFoto;
import com.daw2.viajesclase.models.repository.ViajeFotoRepository;
import com.daw2.viajesclase.service.ViajeFotoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class ViajeFotoServiceImpl implements ViajeFotoService {

    @Autowired
    private ViajeFotoRepository viajeFotoRepository;

    @Override
    public List<ViajeFoto> findAll() {
        return viajeFotoRepository.findAll();
    }

    @Override
    public ViajeFoto findById(Long id) {
        return viajeFotoRepository.findById(id).orElse(null);
    }

    @Override
    public ViajeFoto save(ViajeFoto ViajeFoto) {
        return viajeFotoRepository.save(ViajeFoto);
    }

    @Override
    public void delete(ViajeFoto ViajeFoto) {
        viajeFotoRepository.delete(ViajeFoto);
    }
}

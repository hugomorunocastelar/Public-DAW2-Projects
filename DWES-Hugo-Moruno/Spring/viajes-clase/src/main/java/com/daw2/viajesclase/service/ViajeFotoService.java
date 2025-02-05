package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.ViajeFoto;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface ViajeFotoService {

    List<ViajeFoto> findAll();
    ViajeFoto findById(Long id);
    ViajeFoto save(ViajeFoto ViajeFoto);
    void delete(ViajeFoto ViajeFoto);
    
}

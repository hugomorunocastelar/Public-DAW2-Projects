package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.ViajePago;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface ViajePagoService {

    List<ViajePago> findAll();
    ViajePago findById(Long id);
    ViajePago save(ViajePago ViajePago);
    void delete(ViajePago ViajePago);
    
}

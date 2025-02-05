package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.Viaje;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface ViajeService {

    List<Viaje> findAll();
    Viaje findById(Long id);
    Viaje save(Viaje Viaje);
    void delete(Viaje Viaje);
    
}

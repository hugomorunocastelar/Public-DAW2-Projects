package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.Cliente;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface ClienteService {

    List<Cliente> findAll();
    Cliente findById(Long id);
    Cliente save(Cliente Cliente);
    void delete(Cliente Cliente);
    
}

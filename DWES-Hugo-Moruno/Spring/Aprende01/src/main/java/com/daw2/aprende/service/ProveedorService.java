package com.daw2.aprende.service;

import com.daw2.aprende.models.entity.Proveedor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public interface ProveedorService {

    List<Proveedor> findAll();
    Proveedor findByNif(String nif);
    Proveedor save(Proveedor Proveedor);
    void delete(Proveedor Proveedor);
    
}

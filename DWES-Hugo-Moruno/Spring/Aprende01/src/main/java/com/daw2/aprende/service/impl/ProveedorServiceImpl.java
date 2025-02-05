package com.daw2.aprende.service.impl;

import com.daw2.aprende.models.entity.Proveedor;
import com.daw2.aprende.models.repository.ProveedorRepository;
import com.daw2.aprende.service.ProveedorService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
public class ProveedorServiceImpl implements ProveedorService {

    @Autowired
    private ProveedorRepository proveedorRepository;

    @Override
    public List<Proveedor> findAll() {
        return proveedorRepository.findAll();
    }

    @Override
    public Proveedor findByNif(String nif) {
        return proveedorRepository.findByNif(nif);
    }

    @Override
    public Proveedor save(Proveedor Proveedor) {
        return proveedorRepository.save(Proveedor);
    }

    @Override
    public void delete(Proveedor Proveedor) {
        proveedorRepository.delete(Proveedor);
    }
}

package com.daw2.aprende.service;

import com.daw2.aprende.models.entity.Articulo;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public interface ArticuloService {

    List<Articulo> findAll();
    Articulo findByReference(String reference);
    Articulo save(Articulo Articulo);
    void delete(Articulo Articulo);
    
}

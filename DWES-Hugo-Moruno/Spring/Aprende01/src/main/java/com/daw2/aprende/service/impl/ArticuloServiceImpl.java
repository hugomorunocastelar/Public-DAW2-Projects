package com.daw2.aprende.service.impl;

import com.daw2.aprende.models.entity.Articulo;
import com.daw2.aprende.models.repository.ArticuloRepository;
import com.daw2.aprende.service.ArticuloService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
public class ArticuloServiceImpl implements ArticuloService {

    @Autowired
    private ArticuloRepository articuloRepository;

    @Override
    public List<Articulo> findAll() {
        return articuloRepository.findAll();
    }

    @Override
    public Articulo findByReference(String reference) {
        return articuloRepository.findByReferencia(reference);
    }

    @Override
    public Articulo save(Articulo Articulo) {
        return articuloRepository.save(Articulo);
    }

    @Override
    public void delete(Articulo Articulo) {
        articuloRepository.delete(Articulo);
    }
}

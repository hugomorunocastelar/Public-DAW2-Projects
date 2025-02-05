package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.ViajeDocumento;
import com.daw2.viajesclase.models.repository.ViajeDocumentoRepository;
import com.daw2.viajesclase.service.ViajeDocumentoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class ViajeDocumentoServiceImpl implements ViajeDocumentoService {

    @Autowired
    private ViajeDocumentoRepository viajeDocumentoRepository;

    @Override
    public List<ViajeDocumento> findAll() {
        return viajeDocumentoRepository.findAll();
    }

    @Override
    public ViajeDocumento findById(Long id) {
        return viajeDocumentoRepository.findById(id).orElse(null);
    }

    @Override
    public ViajeDocumento save(ViajeDocumento ViajeDocumento) {
        return viajeDocumentoRepository.save(ViajeDocumento);
    }

    @Override
    public void delete(ViajeDocumento ViajeDocumento) {
        viajeDocumentoRepository.delete(ViajeDocumento);
    }
}

package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.ViajeDocumento;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface ViajeDocumentoService {

    List<ViajeDocumento> findAll();
    ViajeDocumento findById(Long id);
    ViajeDocumento save(ViajeDocumento ViajeDocumento);
    void delete(ViajeDocumento ViajeDocumento);
    
}

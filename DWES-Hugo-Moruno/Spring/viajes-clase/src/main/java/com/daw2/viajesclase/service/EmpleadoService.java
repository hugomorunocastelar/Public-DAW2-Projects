package com.daw2.viajesclase.service;

import com.daw2.viajesclase.models.entity.Empleado;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public interface EmpleadoService {

    List<Empleado> findAll();
    Empleado findById(Long id);
    Empleado save(Empleado Empleado);
    void delete(Empleado Empleado);
    
}

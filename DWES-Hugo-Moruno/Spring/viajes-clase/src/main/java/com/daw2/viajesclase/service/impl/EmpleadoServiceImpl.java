package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.Empleado;
import com.daw2.viajesclase.models.repository.EmpleadoRepository;
import com.daw2.viajesclase.service.EmpleadoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class EmpleadoServiceImpl implements EmpleadoService {

    @Autowired
    private EmpleadoRepository empleadoRepository;

    @Override
    public List<Empleado> findAll() {
        return empleadoRepository.findAll();
    }

    @Override
    public Empleado findById(Long id) {
        return empleadoRepository.findById(id).orElse(null);
    }

    @Override
    public Empleado save(Empleado Empleado) {
        return empleadoRepository.save(Empleado);
    }

    @Override
    public void delete(Empleado Empleado) {
        empleadoRepository.delete(Empleado);
    }
}

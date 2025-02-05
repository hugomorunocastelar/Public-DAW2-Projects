package com.daw2.viajesclase.service.impl;

import com.daw2.viajesclase.models.entity.Cliente;
import com.daw2.viajesclase.models.repository.ClienteRepository;
import com.daw2.viajesclase.service.ClienteService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
public class ClienteServiceImpl implements ClienteService {

    @Autowired
    private ClienteRepository clienteRepository;

    @Override
    public List<Cliente> findAll() {
        return clienteRepository.findAll();
    }

    @Override
    public Cliente findById(Long id) {return clienteRepository.findById(id).orElse(null);}

    @Override
    public Cliente save(Cliente Cliente) {
        return clienteRepository.save(Cliente);
    }

    @Override
    public void delete(Cliente Cliente) {
        clienteRepository.delete(Cliente);
    }
}

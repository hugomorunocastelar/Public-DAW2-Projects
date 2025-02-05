package com.daw2.aprende.service.impl;

import com.daw2.aprende.models.entity.Persona;
import com.daw2.aprende.models.repository.PersonaRepository;
import com.daw2.aprende.service.PersonaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
public class PersonaServiceImpl implements PersonaService {

    @Autowired
    private PersonaRepository personaRepository;

    @Override
    public Persona save(Persona persona) {
        return personaRepository.save(persona);
    }

    @Override
    public List<Persona> findAll() {
        return personaRepository.findAll();
    }

    @Override
    public Persona findByNif(String nif) {
        return personaRepository.findByNif(nif);
    }

    @Override
    public Persona findByNombreAndApellido1AndApellido2(String nombre, String apellido1, String apellido2) {
        return personaRepository.findByNombreAndApellido1AndApellido2(nombre, apellido1, apellido2);
    }

    @Override
    public void delete(Persona persona) {
        personaRepository.delete(persona);
    }
}
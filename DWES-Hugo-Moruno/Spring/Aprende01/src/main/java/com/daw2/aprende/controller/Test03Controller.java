package com.daw2.aprende.controller;
import com.daw2.aprende.models.dto.PersonaDTO;
import com.daw2.aprende.models.entity.Persona;
import com.daw2.aprende.service.impl.PersonaServiceImpl;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.HttpStatusCode;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Slf4j
@RestController
@RequestMapping("/response")
public class Test03Controller {

    @Autowired
    PersonaServiceImpl personaService = new PersonaServiceImpl();

    @GetMapping("/test")
    public String test01()
    {
        return "La clase jpa está funcionando.";
    }

    @PostMapping("/persona")
    public Persona testPersona(String nif, String nombre, String apellido1, String apellido2)
    {
        Persona persona = new Persona();
        persona.setNif(nif);
        persona.setNombre(nombre);
        persona.setApellido1(apellido1);
        persona.setApellido2(apellido2);
        personaService.save(persona);
        return persona;
    }

    @PostMapping("/personatc")
    public Persona testPersonaTC(String nif, String nombre, String apellido1, String apellido2)
    {
        Persona persona = new Persona();
        persona.setNif(nif);
        persona.setNombre(nombre);
        persona.setApellido1(apellido1);
        persona.setApellido2(apellido2);
        try
        {
            personaService.save(persona);
            return persona;
        }
        catch (Exception e)
        {
            return null;
        }
    }

    @GetMapping("/personaall")
    public List<Persona> testPersonaAll()
    {
        return personaService.findAll();
    }

    @PostMapping("/personareq")
    public Persona testPersonaRequest(
            @RequestParam(name="dni") String nif, @RequestParam String nombre,
            @RequestParam String apellido1, @RequestParam String apellido2,
            @RequestParam(required = false, defaultValue = "0") Integer edad)
    {

        log.info("info");
        log.debug("debug");
        log.warn("warn");
        log.error("error");

        Persona persona = new Persona();
        persona.setNif(nif);
        persona.setNombre(nombre);
        persona.setApellido1(apellido1);
        persona.setApellido2(apellido2);
        try
        {
            personaService.save(persona);
            return persona;
        }
        catch (Exception e)
        {
            return null;
        }
    }

    @GetMapping("/personajson")
    public Persona testPersonaJson(Persona persona)
    {
        log.info("info");
        log.debug("debug");
        log.warn("warn");
        log.error("error");
        try
        {
            personaService.save(persona);
            return persona;
        }
        catch (Exception e)
        {
            return null;
        }
    }

    @PostMapping("/personajson2")
    public Persona testPersonaJson2(@RequestBody Persona persona)
    {
        try
        {
            personaService.save(persona);
            return persona;
        }
        catch (Exception e)
        {
            return null;
        }
    }

    @GetMapping("/personajsonnif/{nif}")
    public Persona personaWithNif(@PathVariable String nif)
    {
        Persona persona = personaService.findByNif(nif);
        return persona;
    }

    @PostMapping("/personaResponse")
    public ResponseEntity<?> personaResponse(@RequestBody PersonaDTO PersonaDTO)
    {
        try
        {
            Persona persona = PersonaDTO.to();
            personaService.save(persona);
            return ResponseEntity.status(HttpStatus.OK).body(PersonaDTO.from(persona));
        }
        catch (Exception e)
        {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("/personaResponse/{nif}")
    public Persona personaResponseNif(@PathVariable String nif)
    {
        Persona persona = personaService.findByNif(nif);
        return persona;
    }

}
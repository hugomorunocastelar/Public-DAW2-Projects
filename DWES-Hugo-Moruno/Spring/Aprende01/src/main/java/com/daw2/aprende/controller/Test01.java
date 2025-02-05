package com.daw2.aprende.controller;

import com.daw2.aprende.models.dto.PersonaDTO;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.Arrays;
import java.util.List;

@RestController
public class Test01 {


    @GetMapping("/test01")
    public String test01() {
        return "Mi primer Spring";
    }

    @GetMapping("/test02")
    public PersonaDTO test02() {
//        PersonaDTO hugo = new PersonaDTO("Hugo", "Moruno", "Parra");
        return null;
    }

    @GetMapping("/test03")
    public List<PersonaDTO> test03() {
        List Personas = Arrays.asList(
//            new PersonaDTO("Hugo", "Moruno", "Parra"),
//            new PersonaDTO("Hugo", "Moruno", "Parra"),
//            new PersonaDTO("Hugo", "Moruno", "Parra"),
//            new PersonaDTO("Hugo", "Moruno", "Parra"),
//            new PersonaDTO("Hugo", "Moruno", "Parra")
        );
        return Personas;
    }

}

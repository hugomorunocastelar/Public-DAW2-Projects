package com.daw2.viajesclase.controller;

import com.daw2.viajesclase.models.dto.ViajeDTO;
import com.daw2.viajesclase.models.entity.Viaje;
import com.daw2.viajesclase.service.impl.ViajeServiceImpl;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@CrossOrigin("*")
@Slf4j
@RestController
@RequestMapping("/viajes")
public class ViajesController {

    @Autowired
    ViajeServiceImpl viajeService;

    @GetMapping("")
    public ResponseEntity<?> getViajes()
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ViajeDTO.from(viajeService.findAll()));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PostMapping("")
    public ResponseEntity<?> saveViaje(@RequestBody Viaje viaje)
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ViajeDTO.from(viajeService.save(viaje)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("/{id}")
    public ResponseEntity<?> getViajeId(@PathVariable Long id)
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ViajeDTO.from(viajeService.findById(id)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> updateViaje(@RequestBody Viaje viaje, @PathVariable Long id)
    {
        viaje.setId(id);
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ViajeDTO.from(viajeService.save(viaje)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("")
    public ResponseEntity<?> deleteViaje(@RequestBody Viaje viaje)
    {
        try {
            viajeService.delete(viaje);
            return ResponseEntity.status(HttpStatus.OK).body(ViajeDTO.from(viaje));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }
}

package com.daw2.aprende.controller;

import com.daw2.aprende.models.dto.ArticuloDTO;
import com.daw2.aprende.models.entity.Articulo;
import com.daw2.aprende.service.impl.ArticuloServiceImpl;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@CrossOrigin("*")
@Slf4j
@RestController
@RequestMapping("/articulos")
public class ArticulosController {

    @Autowired
    ArticuloServiceImpl articuloService;

    @GetMapping("/all")
    public ResponseEntity<?> getArticulos() {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ArticuloDTO.from(articuloService.findAll()));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @GetMapping("/{reference}")
    public ResponseEntity<?> getArticulo(@PathVariable String reference) {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ArticuloDTO.from(articuloService.findByReference(reference)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PostMapping("/save")
    public ResponseEntity<?> saveArticulo(@RequestBody Articulo articulo) {
        try {
            articuloService.save(articulo);
            return ResponseEntity.status(HttpStatus.OK).body(ArticuloDTO.from(articulo));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @PostMapping("/delete")
    public ResponseEntity<?> deleteArticulo(@RequestBody Articulo articulo) {
        try {
            articuloService.delete(articulo);
            return ResponseEntity.status(HttpStatus.OK).body(ArticuloDTO.from(articulo));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

}

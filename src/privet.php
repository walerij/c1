<?php
  class Privet {
      function hello($name="John")
      {
          return "hello,"+$name;
      }

      function hi($hello="Привет",$name="Валера")
      {
          return $hello+","+$name+"!";
      }
  }
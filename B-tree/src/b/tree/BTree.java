/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package b.tree;
import java.util.Scanner;

/**
 *
 * @author ExtremeTech
 */
public class BTree {

    /**
     * @param args the command line arguments
     */
    
    
    public static void main(String[] args) {
        tree t = new tree();
        String c = "0";
        Scanner in = new Scanner(System.in);
        while(c.charAt(0)!='4'){
            String s = "";
            System.out.println("Bienvenido a la indexación por medio de B-Trees \n \n");
        
            System.out.println("Seleccione el número con la accion que desee realizar: \n \n");

            System.out.println("1 - Agregar un nuevo elemento. \n");
            System.out.println("2 - Buscar algún elemento. \n");
            System.out.println("3 - Vizualizar el BTree. \n");
            System.out.println("4 - Salir. \n \n");

            System.out.println("Selección: ");
            c = in.nextLine();
            System.out.println("\n \n");
            switch(c){
                case "1":
                    System.out.println("Introduzca el elemento a insertar: ");
                    s = in.nextLine();
                    System.out.println("/n");
                    t.insert(s);
                    break;
                case "2":
                    System.out.println("Introduzca el elemento a buscar: ");
                    s = in.nextLine();
                    System.out.println("/n");
                    if(t.search(s)){
                        System.out.println("El elemento se encuentra indexado.\n");
                    }
                    else{
                        System.out.println("El elemento no se encontró.\n");
                    }
                    break;
                case "3":
                    t.print();
                    System.out.println("\n");
                    break;
                default:
                    break;
            }
        }
        
    }
    
}

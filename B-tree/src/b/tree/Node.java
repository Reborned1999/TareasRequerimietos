/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package b.tree;

/**
 *
 * @author ExtremeTech
 */
public class Node {
    public int numberOfNodes;
    public String key[];
    public Node children[];
    public boolean isLeaf;

    
    Node() {
        key = new String[3];
        children = new Node[4];
        isLeaf = true;
    }
}

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
public class tree {
    public Node root;

    tree() {
        // new root
        root = new Node();
        // assign the root node to be a isLeaf
        root.isLeaf = true;
        root.numberOfNodes = 0;
        // initial the key value in the root to -1 (null)
        root.key[0] = "nada";
    }
    
    public void insert(String k)
    {

        Node r = root;
        if (r.numberOfNodes == 3) {
            Node s = new Node();
            root = s;
            s.numberOfNodes = 0;
            s.isLeaf = false;
            s.children[0] = r;
            splitChild(s, 1, r);
            insertNonfull(s, k);
        }
        else {
            insertNonfull(r, k);
        }
    }
    
    public void insertNonfull(Node node, String value) {
        int i = node.numberOfNodes;
        if (node.isLeaf) {
            while (i >= 1 && stringCompare(value, node.key[i - 1]) < 0) {
                node.key[i] = node.key[i - 1];
                i--;
            }
            node.key[i] = value;
            node.numberOfNodes++;
        }
        else {
            while (i >= 1 && stringCompare(value, node.key[i - 1]) < 0) {
                i--;
            }
            i++;
            if (node.children[i - 1].numberOfNodes == 3) {
                splitChild(node, i, node.children[i - 1]);
                if (stringCompare(value, node.key[i - 1]) > 0) {
                    i++;
                }
            }
            insertNonfull(node.children[i - 1], value);
        }
    }

    public void splitChild(Node parentNode, int childIndex, Node newChild) {
        Node z = new Node();
        z.isLeaf = newChild.isLeaf;
        z.numberOfNodes = 1; 
        z.key[0] = newChild.key[2];
        if (!newChild.isLeaf) {
            z.children[1] = newChild.children[3];
            z.children[0] = newChild.children[2];
        }
        newChild.numberOfNodes = 1;
        for (int j = parentNode.numberOfNodes + 1; j >= childIndex + 1; j--) {
            parentNode.children[j] = parentNode.children[j - 1];
            parentNode.key[j - 1] = parentNode.key[j - 2];
        }
        parentNode.children[childIndex] = z;
        parentNode.key[childIndex - 1] = newChild.key[1];
        parentNode.numberOfNodes++;
    }

    public boolean search(Node node, String value) {
        int i = 1;
        while (i <= node.numberOfNodes && stringCompare(value, node.key[i - 1]) > 0) {
            i++;
        }
        if (i <= node.numberOfNodes && stringCompare(value, node.key[i - 1]) == 0) {
            return true;
        }
        if (!node.isLeaf) {
            return search(node.children[i - 1], value);
        }
        return false;
    }

    public boolean search(String k) {
        Node x = root;
        return search(x, k);
    }

    public boolean delete(String k) {
        Node x = root;
        return delete(x, k);
    }
    
    public boolean delete(Node node, String value) {
        int i = 1;
        while (i <= node.numberOfNodes && stringCompare(value, node.key[i - 1]) > 0) {
            i++;
        }
        if (node.isLeaf) {
            if (i <= node.numberOfNodes && stringCompare(value, node.key[i - 1]) == 0) {
                node.key[i - 1] = "";
                for(int j = i - 1; j < node.numberOfNodes - 1; j++){
                    node.key[j] = node.key[j+1];
                    if(j+1 == node.numberOfNodes - 1)
                        node.numberOfNodes--;                    
                }
                return true;
            }
        } else {
            return delete(node.children[i - 1], value);
        }
        return false;
    }
    
    public void print() {
        printBtree(root, "");
    }
    
    public void printBtree(Node node, String indent) {
        if (node == null) {
            System.out.println(indent + "The B-Tree is Empty");
        } else {
            System.out.println(indent + " ");
            String childIndent = indent + "\t";
            for (int i = node.numberOfNodes-1; i >= 0; i--) {
                if (!node.isLeaf){
                    printBtree(node.children[i], childIndent);
                }
                if(stringCompare(node.key[i], "") > 0)
                    System.out.println(childIndent + node.key[i]);
            }
            if (!node.isLeaf){
                printBtree(node.children[node.numberOfNodes], childIndent);
            }
        }
    }
    
    public static int stringCompare(String str1, String str2){ 
  
        int l1 = str1.length(); 
        int l2 = str2.length(); 
        int lmin = Math.min(l1, l2); 
  
        for (int i = 0; i < lmin; i++) { 
            int str1_ch = (int)str1.charAt(i); 
            int str2_ch = (int)str2.charAt(i); 
  
            if (str1_ch != str2_ch) { 
                return str1_ch - str2_ch; 
            } 
        } 
        if (l1 != l2) { 
            return l1 - l2; 
        } 
        else { 
            return 0; 
        } 
    }
}

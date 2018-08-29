
package gateagents;
import java.io.*;


public class GateAgents {


    public static void main(String[] args) {
        
        
        flightBoarding flightCapacity = new flightBoarding(10);
        boolean capIsFull = false;
        try {
            FileInputStream fstream = new FileInputStream("AAData.txt");
        
            DataInputStream in = new DataInputStream(fstream);
        
            BufferedReader br = new BufferedReader(new InputStreamReader(in));

            String temp; 
        
            String currFlight = br.readLine();  //first line contains the current flight name
        
            //System.out.println(currFlight);
            
        
            while((temp = br.readLine()) != null)   //read line by line
            {
                String[] toSplit;
                String delimiter = " ";
                
                toSplit = temp.split(delimiter);
                
                String customerName = toSplit[0];
                String flightNumber = toSplit[1];
                String priorityLevel = toSplit[2];
                
                //System.out.println(customerName + flightNumber + priorityLevel);
                
                
               if (!currFlight.equals(flightNumber))  //if person is in wrong flight
                {
                        System.out.print("This customer, ");
                        System.out.print(customerName);
                        System.out.print(" is in the wrong flight, please direct him to his correct flight.");
                        System.out.print("\n");
                        continue;
                }




                if (capIsFull == true) //if capacity is already full, we only check to see if theres priority customers left out
                {
                        if (!priorityLevel.equals("Low"))
                        {
                                flightCapacity.addToRemainingList(customerName); //add the priority customer to priority vector

                        }
                        continue; //if not priority, just continue
                }



               if (priorityLevel.equals("Low"))
               {
                        flightCapacity.addToLowList(customerName);

                }


                if (flightCapacity.updateNumberBoarded().equals("You can continue"))
                {
                        continue;

                }
                else
                { //capacity has been met
                        //int curr = flightCapacity.capacity;
                        capIsFull = true;

                }
                

                
            
            }
            in.close();
            
        } catch (Exception e) {
            System.err.println("Error: " + e.getMessage());
        }

            
    
    
        
       while (flightCapacity.remainingPriorityCustomers != 0)
       {
            flightCapacity.removeAndExchangeCustomer();

       }
       
       
       
    }


 }
    


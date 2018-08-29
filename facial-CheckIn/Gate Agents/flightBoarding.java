/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gateagents;
import java.util.ArrayList;




public class flightBoarding
{


	public flightBoarding(int cap)
	{
		capacity = cap;
		numberBoarded = 0;
		remainingPriorityCustomers = 0;
		//might add a totalTicketsBought integer here
	}

	public final String updateNumberBoarded()
	{
		numberBoarded = numberBoarded + 1;

		if (numberBoarded == capacity)
		{
			return "We've reached max capacity!";

		}
		else
		{
			return "You can continue";
		}

	}

	public int capacity;
	public int numberBoarded;
	public int remainingPriorityCustomers;
	public int totalTicketsBought;



//C++ TO JAVA CONVERTER TODO TASK: The implementation of the following method could not be found:
//	String flightNumber();
	public ArrayList<String> lowPriorityList = new ArrayList<String>();
	public ArrayList<String> remainingHighPriority = new ArrayList<String>();
	public ArrayList<String> removedCustomers = new ArrayList<String>();



	public void addToRemainingList(String name)
	{
		remainingHighPriority.add(name);
		remainingPriorityCustomers = remainingPriorityCustomers + 1;
	}


	public void addToLowList(String name)
	{
		lowPriorityList.add(name);

	}

	public void removeAndExchangeCustomer()
	{
		String removedCustomer = lowPriorityList.get(lowPriorityList.size() - 1); //access the name of the customer we are removing
		System.out.print("We are removing ");
		System.out.print(removedCustomer);
		System.out.print("\n");
		removedCustomers.add(removedCustomer); //add that customer to list of removed customers to reaccomidate them later
		lowPriorityList.remove(lowPriorityList.size() - 1); //remove him from flight
		remainingHighPriority.remove(remainingHighPriority.size() - 1); //put this remaining high priority customer into flight and remove him from list
		remainingPriorityCustomers = remainingPriorityCustomers - 1; //update remaining priority customers
	}
}
